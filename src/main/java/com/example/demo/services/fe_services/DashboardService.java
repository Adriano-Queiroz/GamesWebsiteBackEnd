package com.example.demo.services.fe_services;

import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.cglib.core.Local;
import org.springframework.stereotype.Service;

import java.time.LocalDate;

@Service
public class DashboardService {
    @Autowired
    private IDepositRepository iDepositRepository;
    @Autowired
    private IWithdrawalRepository iWithdrawalRepository;
    @Autowired
    private IUserModelRepository iUserModelRepository;
    @Autowired
    private IHistoryRepository iHistoryRepository;

    public double getTotalDeposits() {
        return iDepositRepository.getTotalDeposits();
    }

    public double getTotalWithdrawals() {
        return iWithdrawalRepository.getTotalWithdrawals();
    }

    public double getTotalDepositsBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iDepositRepository.getTotalDepositsBetweenDates(startDate, endDate);
    }
    public double getTotalWithdrawalsBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iWithdrawalRepository.getTotalWithdrawalsBetweenDates(startDate, endDate);
    }
    public double getTotalBalance(){
        return iUserModelRepository.getTotalBalance();
    }
    public double getTotalGainPerPercentageBetweenDates(LocalDate startDate, LocalDate endDate){
        return iHistoryRepository.getTotalMoneyGainedBetweenDates(startDate.atStartOfDay(), endDate.atStartOfDay());
    }
    public double getTotalGainPerPercentage(){
        return iHistoryRepository.getTotalMoneyGained();
    }
}
