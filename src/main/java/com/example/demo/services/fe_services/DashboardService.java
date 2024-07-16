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
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;

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

    public double getTotalBalance() {
        return iUserModelRepository.getTotalBalance();
    }

    public double getTotalGainPerPercentageBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iHistoryRepository.getTotalMoneyGainedBetweenDates(startDate.atStartOfDay(), endDate.atStartOfDay());
    }

    public double getTotalGainPerPercentage() {
        return iHistoryRepository.getTotalMoneyGained();
    }

    public Page<DepositDTO> getAllDeposits(Pageable pageable) {
        return iDepositRepository.findAllByOrderByDateDesc(pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        ));
    }

    public Page<DepositDTO> getAllDepositsBetweenDates(LocalDate startDate, LocalDate endDate, Pageable pageable) {
        return iDepositRepository.findAllByDateBetween(startDate, endDate, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        ));
    }

    public Page<DepositDTO> getAllDepositsByStatus(DepositStatus status, Pageable pageable) {
        return iDepositRepository.findAllByStatus(status, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        ));
    }

    public Page<DepositDTO> getAllDepositsByStatusBetweenDates(DepositStatus status, LocalDate startDate, LocalDate endDate, Pageable pageable) {
        return iDepositRepository.findAllByStatusAndDateBetween(status, startDate, endDate, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()
        ));
    }

    public Page<DepositDTO> getAllWithdrawals(Pageable pageable) {
        return iWithdrawalRepository.findAllByOrderByDateDesc(pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()
        ));
    }

    public Page<DepositDTO> getAllWithdrawalsBetweenDates(LocalDate startDate, LocalDate endDate, Pageable pageable) {
        return iWithdrawalRepository.findAllByDateBetween(startDate, endDate, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()
        ));
    }

    public Page<DepositDTO> getAllWithdrawalsByStatus(WithdrawalStatus status, Pageable pageable) {
        return iWithdrawalRepository.findAllByStatus(status, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()
        ));
    }

    public Page<DepositDTO> getAllWithdrawalsByStatusBetweenDates(WithdrawalStatus status, LocalDate startDate, LocalDate endDate, Pageable pageable) {
        return iWithdrawalRepository.findAllByStatusAndDateBetween(status, startDate, endDate, pageable).map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.SAQUE.toString()
        ));
    }
}

