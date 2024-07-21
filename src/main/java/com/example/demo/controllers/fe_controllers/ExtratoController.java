package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.user.UserModel;
import com.example.demo.models.user.role.UserRoles;
import com.example.demo.models.withdrawal.WithdrawalStatus;
import com.example.demo.services.fe_services.DashboardService;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageImpl;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
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
                               @RequestParam(value = "page", defaultValue = "1") int page,
                               @RequestParam(value = "size", defaultValue = "10") int size,
                               @RequestParam(value = "list", defaultValue = "depositsAndWithdrawalsList") String list,
                               HttpSession session) {
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");
        if(!user.getUserRole().equals( UserRoles.ADMIN))
            return "redirect:/login";

        model.addAttribute("user", user);

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
            double deposits = dashboardService.getTotalDepositsBetweenDates(startDate, endDate, DepositStatus.APROVADO);
            model.addAttribute("totalDeposits", deposits);

            double withdrawals = dashboardService.getTotalWithdrawalsBetweenDates(startDate,endDate, WithdrawalStatus.APROVADO);
            model.addAttribute("totalWithdrawals", withdrawals);

            Page<DepositDTO> withdrawalsList = dashboardService.getAllWithdrawalsBetweenDates(startDate,endDate, pageable);
            model.addAttribute("withdrawalsList", withdrawalsList);

            Page<DepositDTO> depositsList = dashboardService.getAllDepositsBetweenDates(startDate,endDate, pageable);
            model.addAttribute("depositsList", depositsList);


            List<DepositDTO> combinedList = new ArrayList<>();
            combinedList.addAll(withdrawalsList.getContent());
            combinedList.addAll(depositsList.getContent());

            List<DepositDTO> sortedList = combinedList.stream()
                    .sorted(Comparator.comparing(DepositDTO::date).reversed())
                    .collect(Collectors.toList());

            Page<DepositDTO> depositsAndWithdrawalsPage = new PageImpl<>(sortedList, pageable, sortedList.size());
            model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsPage);

            switch (list) {
                case "depositsAndWithdrawalsList" ->
                        model.addAttribute("depositsAndWithdrawalsList", withdrawalsList);
                case "withdrawalsList" ->
                        model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsPage);
                default ->
                        model.addAttribute("depositsAndWithdrawalsList", depositsList);
            }

           // model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsList);
            Page<DepositDTO> aprovadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus.APROVADO,startDate,endDate, pageable);
            model.addAttribute("aprovadoList",aprovadoList);

            Page<DepositDTO> solicitadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus.SOLICITADO,startDate,endDate, pageable);
            model.addAttribute("solicitadoList",solicitadoList);

            //List<DepositDTO> fechadoList =  dashboardService.getAllWithdrawalsByStatusBetweenDates(Wit.FECHADO,startDate,endDate);
            //model.addAttribute("fechadoList",fechadoList);

        } else {
            model.addAttribute("totalDeposits", dashboardService.getTotalDeposits(DepositStatus.APROVADO));
            model.addAttribute("totalWithdrawals", dashboardService.getTotalWithdrawals(WithdrawalStatus.APROVADO));
            model.addAttribute("moneyGained", dashboardService.getTotalGainPerPercentage());
            model.addAttribute("withdrawalsList", dashboardService.getAllWithdrawals(pageable));
            model.addAttribute("depositsList", dashboardService.getAllDeposits(pageable));
            model.addAttribute("aprovadoList",dashboardService.getAllWithdrawalsByStatus(WithdrawalStatus.APROVADO,pageable));
            model.addAttribute("solicitadoList",dashboardService.getAllWithdrawalsByStatus(WithdrawalStatus.SOLICITADO,pageable));
            Page<DepositDTO> depositsPage = dashboardService.getAllDeposits(pageable);
            Page<DepositDTO> withdrawalsPage = dashboardService.getAllWithdrawals(pageable);

// Extract content from pages
            List<DepositDTO> depositsList = depositsPage.getContent();
            List<DepositDTO> withdrawalsList = withdrawalsPage.getContent();

// Combine lists
            List<DepositDTO> depositsAndWithdrawalsList = new ArrayList<>();
            depositsAndWithdrawalsList.addAll(depositsList);
            depositsAndWithdrawalsList.addAll(withdrawalsList);

// Sort combined list by date in reverse order
            List<DepositDTO> sortedList = depositsAndWithdrawalsList.stream()
                    .sorted(Comparator.comparing(DepositDTO::date).reversed())
                    .collect(Collectors.toList());

// Convert sorted list back to a Page object
            Page<DepositDTO> depositsAndWithdrawalsPage = new PageImpl<>(sortedList, pageable, sortedList.size());

// Add to model
            switch (list) {
                case "withdrawalsList" ->
                        model.addAttribute("depositsAndWithdrawalsList", withdrawalsPage);
                case "depositsAndWithdrawalsList" ->
                        model.addAttribute("depositsAndWithdrawalsList", depositsAndWithdrawalsPage);
                default ->
                        model.addAttribute("depositsAndWithdrawalsList", depositsPage);
            }
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
