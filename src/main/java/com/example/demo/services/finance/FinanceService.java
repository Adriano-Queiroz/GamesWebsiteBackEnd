package com.example.demo.services.finance;

import com.example.demo.repositories.IDepositRepository;
import com.example.demo.repositories.IWithdrawalRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class FinanceService {

    @Autowired
    private IDepositRepository iDepositRepository;
    @Autowired
    private IWithdrawalRepository iWithdrawalRepository;
    /*

    public double getTotalDeposits(){
        return iDepositRepository.getTotalDeposits();
    }
    public double getTotalWithdrawals(){
        return iWithdrawalRepository.getTotalWithdrawals();
    }

     */
}
