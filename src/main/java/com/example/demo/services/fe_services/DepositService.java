package com.example.demo.services.fe_services;

import com.example.demo.dtos.deposits.DepositDTO;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.deposit.ExtratoType;
import com.example.demo.repositories.IDepositRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

@Service
public class DepositService {
    @Autowired
    private IDepositRepository iDepositRepository;
    public double getTotalDeposits() {
        return iDepositRepository.getTotalDeposits();
    }
    public double getTotalDepositsBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iDepositRepository.getTotalDepositsBetweenDates(startDate, endDate);
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
    public List<DepositDTO> getAllByStatus(DepositStatus status){
        return iDepositRepository.findAllByStatus(status).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()

        )).toList();
    }
    public List<DepositDTO> getAllByStatusBetweenDates(DepositStatus status, LocalDate startDate, LocalDate endDate){
        return iDepositRepository.findAllByStatusAndDateBetween(status,startDate,endDate).stream().map(depositModel -> new DepositDTO(
                depositModel.getDate(),
                depositModel.getUser().getUsername(),
                depositModel.getAmount(),
                depositModel.getStatus().toString(),
                ExtratoType.DEPÓSITO.toString()

        )).toList();
    }
}
