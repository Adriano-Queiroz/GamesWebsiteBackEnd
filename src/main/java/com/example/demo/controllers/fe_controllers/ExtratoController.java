package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.withdrawal.WithdrawalStatus;
import com.example.demo.services.fe_services.DashboardService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.stream.Collectors;

@Controller
public class ExtratoController {
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd");
    @Autowired
    private DashboardService dashboardService;

    @GetMapping("/extrato")
    public String getDashboard(@RequestParam(value = "startDate", required = false) String startDateStr,
                               @RequestParam(value = "endDate", required = false) String endDateStr,
                               Model model,
                               HttpSession session) {
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        model.addAttribute("user", session.getAttribute("user"));
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
            double deposits = dashboardService.getTotalDepositsBetweenDates(startDate, endDate, DepositStatus.APROVADO);
            model.addAttribute("totalDeposits", deposits);

            double withdrawals = dashboardService.getTotalWithdrawalsBetweenDates(startDate,endDate, WithdrawalStatus.APROVADO);
            model.addAttribute("totalWithdrawals", withdrawals);


            List<DepositDTO> withdrawalsList = dashboardService.getAllWithdrawalsBetweenDates(startDate,endDate);
            model.addAttribute("withdrawalsList", withdrawalsList);

            List<DepositDTO> depositsList = dashboardService.getAllDepositsBetweenDates(startDate,endDate);
            model.addAttribute("depositsList", depositsList);

            List<DepositDTO> depositsAndWithdrawalsList = new ArrayList<>();
            depositsAndWithdrawalsList.addAll(withdrawalsList);
            depositsAndWithdrawalsList.addAll(depositsList);

            depositsAndWithdrawalsList = depositsAndWithdrawalsList.stream()
                    .sorted(Comparator.comparing(DepositDTO::date).reversed())
                    .collect(Collectors.toList());

            model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsList);
            List<DepositDTO> aprovadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus.APROVADO,startDate,endDate);
            model.addAttribute("aprovadoList",aprovadoList);

            List<DepositDTO> solicitadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus.SOLICITADO,startDate,endDate);
            model.addAttribute("solicitadoList",solicitadoList);

            //List<DepositDTO> fechadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(Wit.FECHADO,startDate,endDate);
            //model.addAttribute("fechadoList",fechadoList);

        } else {
            model.addAttribute("totalDeposits", dashboardService.getTotalDeposits(DepositStatus.APROVADO));
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawals(WithdrawalStatus.APROVADO));
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentage());
            model.addAttribute("withdrawalsList", dashboardService.getAllWithdrawals());
            model.addAttribute("depositsList", dashboardService.getAllDeposits());
            model.addAttribute("aprovadoList",dashboardService.getAllWithdrawalsByStatus(WithdrawalStatus.APROVADO));
            model.addAttribute("solicitadoList",dashboardService.getAllWithdrawalsByStatus(WithdrawalStatus.SOLICITADO));
            List<DepositDTO> depositsAndWithdrawalsList = new ArrayList<>();
            depositsAndWithdrawalsList.addAll(dashboardService.getAllDeposits());
            depositsAndWithdrawalsList.addAll(dashboardService.getAllWithdrawals());

            depositsAndWithdrawalsList = depositsAndWithdrawalsList.stream()
                    .sorted(Comparator.comparing(DepositDTO::date).reversed())
                    .collect(Collectors.toList());

            model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsList);
        }
        model.addAttribute("totalBalance", dashboardService.getTotalBalance());
        model.addAttribute("startDate", startDate != null ? startDate.toString() + " -" :"(Desde o Início)");
        model.addAttribute("endDate", endDate != null ? endDate.toString():"");


        return "extrato";
    }

    @PostMapping("/extrato-date")
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
        return "redirect:/extrato";
    }
}
