package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.ajustes.ActivateBonusDTO;
import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import com.example.demo.services.fe_services.AdminService;
import com.example.demo.services.fe_services.DashboardService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.format.annotation.DateTimeFormat;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.List;

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

        if (startDate != null && endDate != null) {
            double deposits = dashboardService.getTotalDepositsBetweenDates(startDate, endDate);
            model.addAttribute("totalDeposits", deposits);

            double withdrawals = dashboardService.getTotalWithdrawalsBetweenDates(startDate,endDate);
            model.addAttribute("totalWithdrawals", withdrawals);

            double moneyGained = dashboardService.getTotalGainPerPercentageBetweenDates(startDate,endDate);
            model.addAttribute("moneyGained", moneyGained);

            List<DepositDTO> depositsList = dashboardService.getAllDepositsBetweenDates(startDate,endDate);
            model.addAttribute("depositsList", depositsList);

            List<DepositDTO> aprovadoList =  dashboardService.getAllByStatusBetweenDates(DepositStatus.APROVADO,startDate,endDate);
            model.addAttribute("aprovadoList",aprovadoList);

            List<DepositDTO> abertoList =  dashboardService.getAllByStatusBetweenDates(DepositStatus.ABERTO,startDate,endDate);
            model.addAttribute("abertoList",abertoList);

            List<DepositDTO> fechadoList =  dashboardService.getAllByStatusBetweenDates(DepositStatus.FECHADO,startDate,endDate);
            model.addAttribute("fechadoList",fechadoList);

        } else {
            model.addAttribute("totalDeposits", dashboardService.getTotalDeposits());
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawals());
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentage());
            model.addAttribute("depositsList", dashboardService.getAllDeposits());
            model.addAttribute("aprovadoList",dashboardService.getAllByStatus(DepositStatus.APROVADO));
            model.addAttribute("abertoList",dashboardService.getAllByStatus(DepositStatus.ABERTO));
            model.addAttribute("fechadoList",dashboardService.getAllByStatus(DepositStatus.FECHADO));

        }
        model.addAttribute("totalBalance", dashboardService.getTotalBalance());
        model.addAttribute("startDate", startDate != null ? startDate.toString() + " -" :"(Desde o Início)");
        model.addAttribute("endDate", endDate != null ? endDate.toString():"");

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
