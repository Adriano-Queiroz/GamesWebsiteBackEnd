package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.ajustes.ActivateBonusDTO;
import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.withdrawal.WithdrawalStatus;
import com.example.demo.services.fe_services.AdminService;
import com.example.demo.services.fe_services.DashboardService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.List;

import org.springframework.data.domain.Page;

@Controller
public class DashboardController {

    @Autowired
    private AdminService adminService;

    @Autowired
    private DashboardService dashboardService;

    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    @GetMapping("/dashboard")
    public String getDashboard(@RequestParam(value = "startDate", required = false) String startDateStr,
                               @RequestParam(value = "endDate", required = false) String endDateStr,
                               @RequestParam(value = "page", defaultValue = "1") int page,
                               @RequestParam(value = "size", defaultValue = "10") int size,
                               @RequestParam(value = "list", defaultValue = "depositsList") String list,
                               Model model) {
        LocalDate startDate = null;
        LocalDate endDate = null;
        try {
            if (startDateStr != null) {
                startDate = LocalDate.parse(startDateStr, DATE_FORMATTER);
            }
            if (endDateStr != null) {
                endDate = LocalDate.parse(endDateStr, DATE_FORMATTER);
            }
        } catch (DateTimeParseException e) {
            // Handle the exception, e.g., set default dates or show an error message
        }

        Pageable pageable = PageRequest.of(page - 1, size);

        if (startDate != null && endDate != null) {
            model.addAttribute("totalDeposits", dashboardService.getTotalDepositsBetweenDates(startDate, endDate, DepositStatus.APROVADO));
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawalsBetweenDates(startDate, endDate, WithdrawalStatus.APROVADO));
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentageBetweenDates(startDate, endDate));
            switch (list) {
                case "depositsList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsBetweenDates(startDate, endDate, pageable));
                case "aprovadoList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.APROVADO, startDate, endDate, pageable));
                case "abertoList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.ABERTO, startDate, endDate, pageable));
                default ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.FECHADO, startDate, endDate, pageable));
            }

            model.addAttribute("aprovadoList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.APROVADO, startDate, endDate, pageable));
            model.addAttribute("abertoList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.ABERTO, startDate, endDate, pageable));
            model.addAttribute("fechadoList", dashboardService.getAllDepositsByStatusBetweenDates(DepositStatus.FECHADO, startDate, endDate, pageable));
        } else {
            model.addAttribute("totalDeposits", dashboardService.getTotalDeposits(DepositStatus.APROVADO));
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawals(WithdrawalStatus.APROVADO));
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentage());

            switch (list) {
                case "depositsList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDeposits(pageable));
                case "aprovadoList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatus(DepositStatus.APROVADO, pageable));
                case "abertoList" ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatus(DepositStatus.ABERTO, pageable));
                default ->
                        model.addAttribute("depositsList", dashboardService.getAllDepositsByStatus(DepositStatus.FECHADO, pageable));
            }
            model.addAttribute("aprovadoList", dashboardService.getAllDepositsByStatus(DepositStatus.APROVADO, pageable));
            model.addAttribute("abertoList", dashboardService.getAllDepositsByStatus(DepositStatus.ABERTO, pageable));
            model.addAttribute("fechadoList", dashboardService.getAllDepositsByStatus(DepositStatus.FECHADO, pageable));
        }

        model.addAttribute("totalBalance", dashboardService.getTotalBalance());
        model.addAttribute("startDate", startDate != null ? startDate.toString() + " -" : "(Desde o Início)");
        model.addAttribute("endDate", endDate != null ? endDate.toString() : "");

        model.addAttribute("BonusBoasVindas", adminService.getGlobal("BonusBoasVindas"));
        model.addAttribute("BonusRecargaDiaria", adminService.getGlobal("BonusRecargaDiaria"));
        model.addAttribute("BonusPrimeiraRecarga", adminService.getGlobal("BonusPrimeiraRecarga"));

        return "dashboard";
    }

    @PostMapping("/dashboard-date")
    public String handleDateSubmission(@RequestParam("startDate") String startDateStr,
                                       @RequestParam("endDate") String endDateStr,
                                       RedirectAttributes redirectAttributes) {
        if(!startDateStr.equals("") && !endDateStr.equals("")){
            LocalDate startDate = LocalDate.parse(startDateStr, DATE_FORMATTER);
            LocalDate endDate = LocalDate.parse(endDateStr, DATE_FORMATTER);
        }

        // Add attributes to RedirectAttributes
        redirectAttributes.addAttribute("startDate", startDateStr);
        redirectAttributes.addAttribute("endDate", endDateStr);

        // Redirect to the GET /dashboard with parameters
        return "redirect:/dashboard";
    }

    @PostMapping("/changeBonusStatus")//chamada por script no html
    public void changeBonusStatus(@RequestBody ActivateBonusDTO dto){
        adminService.controlBonus(dto.bonusName(), dto.newStatus());
    }
}
