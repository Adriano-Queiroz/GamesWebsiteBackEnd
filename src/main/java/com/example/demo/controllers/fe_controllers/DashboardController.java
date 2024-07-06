package com.example.demo.controllers.fe_controllers;

import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IWithdrawalRepository;
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

@Controller
public class DashboardController {
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

        } else {
            model.addAttribute("totalDeposits", dashboardService.getTotalDeposits());
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawals());
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentage());
        }
        model.addAttribute("totalBalance", dashboardService.getTotalBalance());
        model.addAttribute("startDate", startDate != null ? startDate.toString() + " -" :"(Desde o Início)");
        model.addAttribute("endDate", endDate != null ? endDate.toString():"");

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

}
