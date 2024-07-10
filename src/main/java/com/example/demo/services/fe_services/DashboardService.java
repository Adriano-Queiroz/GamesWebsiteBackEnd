package com.example.demo.services.fe_services;

import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.deposit.ExtratoType;
import com.example.demo.models.withdrawal.WithdrawalStatus;
import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import org.springframework.beans.factory.annotation.Autowired;
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

    public double getTotalDeposits(DepositStatus status) {
        return iDepositRepository.getTotalDeposits(status);
    }

    public double getTotalWithdrawals(WithdrawalStatus status) {
        return iWithdrawalRepository.getTotalWithdrawals(status);
    }

    public double getTotalDepositsBetweenDates(LocalDate startDate, LocalDate endDate, DepositStatus status) {
        return iDepositRepository.getTotalDepositsBetweenDates(startDate, endDate, status);
    }
    public double getTotalWithdrawalsBetweenDates(LocalDate startDate, LocalDate endDate, WithdrawalStatus status) {
        return iWithdrawalRepository.getTotalWithdrawalsBetweenDates(startDate, endDate, status);
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
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        )).toList();
    }
    public List<DepositDTO> getAllDepositsBetweenDates(LocalDate startDate, LocalDate endDate){
        return iDepositRepository.findAllByDateBetween(startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        )).toList();
    }
    public List<DepositDTO> getAllDepositsByStatus(DepositStatus status){
        return iDepositRepository.findAllByStatus(status).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()

        )).toList();
    }
    public List<DepositDTO> getAllDepositsByStatusBetweenDates(DepositStatus status, LocalDate startDate, LocalDate endDate){
        return iDepositRepository.findAllByStatusAndDateBetween(status,startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()

        )).toList();
    }
    public List<DepositDTO> getAllWithdrawals(){
        return iWithdrawalRepository.findAllByOrderByDateDesc().stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()

        )).toList();
    }
    public List<DepositDTO> getAllWithdrawalsBetweenDates(LocalDate startDate, LocalDate endDate){
        return iWithdrawalRepository.findAllByDateBetween(startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()

        )).toList();
    }
    public List<DepositDTO> getAllWithdrawalsByStatus(WithdrawalStatus status){
        return iWithdrawalRepository.findAllByStatus(status).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()

        )).toList();
    }
    public List<DepositDTO> getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus status, LocalDate startDate, LocalDate endDate){
        return iWithdrawalRepository.findAllByStatusAndDateBetween(status,startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()

        )).toList();
    }
}
