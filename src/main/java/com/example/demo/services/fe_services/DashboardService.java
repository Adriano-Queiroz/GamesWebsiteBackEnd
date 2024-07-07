package com.example.demo.services.fe_services;

import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.cglib.core.Local;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

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
    public List<DepositDTO> getAllDeposits(){
        return iDepositRepository.findAllByOrderByDateDesc().stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString()
        )).toList();
    }
    public List<DepositDTO> getAllDepositsBetweenDates(LocalDate startDate, LocalDate endDate){
        return iDepositRepository.findAllByDateBetween(startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString()
        )).toList();
    }
    public List<DepositDTO> getAllByStatus(DepositStatus status){
        return iDepositRepository.findAllByStatus(status).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString()
        )).toList();
    }
    public List<DepositDTO> getAllByStatusBetweenDates(DepositStatus status, LocalDate startDate, LocalDate endDate){
        return iDepositRepository.findAllByStatusAndDateBetween(status,startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString()
        )).toList();
    }
}
