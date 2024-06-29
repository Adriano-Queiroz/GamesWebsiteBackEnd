package com.example.demo.fe_controlers;

import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import com.example.demo.services.fe_services.DashboardService;
import com.example.demo.services.finance.FinanceService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.Mapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
public class DashboardController {
    @Autowired
    private DashboardService dashboardService;
    @GetMapping("/dashboard")
    public String getDashboard(Model model){
        double deposits = dashboardService.getTotalDeposits();
        double withdrawals = dashboardService.getTotalWithdrawals();
        model.addAttribute("totalDeposits", deposits);
        model.addAttribute("totalWithdrawals", withdrawals);
        return "dashboard";
    }
}
