package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.Deposit_WithdrawalDTO;
import com.example.demo.dtos.history.HistoryInfoDTO;
import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.models.user.role.UserRoleModel;
import com.example.demo.models.user.role.UserRoles;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.UserService;
import com.example.demo.services.fe_services.AdminService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.server.ResponseStatusException;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;

@Controller
public class AccountPagesController {

    @Autowired
    private AdminService adminService;
    @Autowired
    private UserService userService;

    @GetMapping("/profile")
    public String profile(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");


        model.addAttribute("user", user);

        return "profile";
    }

    @GetMapping("/transactions")
    public String transactions(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");


        model.addAttribute("transactions",userService.getTransactions(null,user.getCodUser(),null,null,null,null,null,null));

        model.addAttribute("user",user);

        return "transactions";
    }
    @GetMapping("/getTransactions")
    @ResponseBody
    public List<Deposit_WithdrawalDTO> transactions(
            @RequestParam(name = "external_reference_ID", required = false) String externalReferenceIdStr,
            @RequestParam(name = "accounts_user_selected") Long accountUserSelected,
            @RequestParam(name = "type", required = false) String type,
            @RequestParam(name = "status", required = false) String status,
            @RequestParam(name = "created_at__from", required = false) String createdAtFrom,
            @RequestParam(name = "created_at__to", required = false) String createdAtTo) {

        // Convert externalReferenceId to Long, considering it might be blank or null
        Long externalReferenceId = parseLongOrNull(externalReferenceIdStr);

        // Clean and validate date inputs
        LocalDateTime fromDateTime = parseDateTime(createdAtFrom);
        LocalDateTime toDateTime = parseDateTime(createdAtTo);

        LocalDate fromDate = fromDateTime != null ? fromDateTime.toLocalDate() : null;
        LocalDate toDate = toDateTime != null ? toDateTime.toLocalDate() : null;

        return userService.getTransactions(
                externalReferenceId,
                accountUserSelected,
                isBlank(type) ? null : type,
                isBlank(status) ? null : status,
                fromDateTime,
                toDateTime,
                fromDate,
                toDate
        );
    }

    private LocalDateTime parseDateTime(String dateTime) {
        return (dateTime != null && !dateTime.isBlank()) ? LocalDateTime.parse(dateTime) : null;
    }

    private Long parseLongOrNull(String str) {
        try {
            return (str != null && !str.isBlank()) ? Long.parseLong(str) : null;
        } catch (NumberFormatException e) {
            return null;
        }
    }

    private boolean isBlank(String str) {
        return str == null || str.isBlank();
    }

    @GetMapping("/bets")
    public String bets(Model model,HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");

        List<HistoryInfoDTO> historyInfo = userService.getHistory(user);

        model.addAttribute("histories", historyInfo);

        model.addAttribute("user",session.getAttribute("user"));

        return "bets";
    }

}
