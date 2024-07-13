package com.example.demo.dtos;

import com.example.demo.models.deposit.DepositModel;
import com.example.demo.models.withdrawal.WithdrawalModel;

import java.util.List;

public record Deposit_WithdrawalDTO(
        long id,
        double amount,
        long codUser,
        String type,
        String date,
        String dateTime,
        String status
) {

    public static List<Deposit_WithdrawalDTO> fromDepositModel(List<DepositModel> deposits) {
        return deposits.stream().map(deposit -> new Deposit_WithdrawalDTO(
                deposit.getCodDeposit(),
                deposit.getAmount(),
                deposit.getUser().getCodUser(),
                "deposit", // "deposit" or "withdrawal"
                deposit.getDate().toString(),
                deposit.getDateTime().toString(),
                deposit.getStatus().toString()
        )).toList();
    }

    public static List<Deposit_WithdrawalDTO> fromWithdrawalModel(List<WithdrawalModel> withdrawals) {
        return withdrawals.stream().map(deposit -> new Deposit_WithdrawalDTO(
                deposit.getCodWithdrawal(),
                deposit.getAmount(),
                deposit.getUser().getCodUser(),
                "withdrawal", // "deposit" or "withdrawal"
                deposit.getDate().toString(),
                null,
                deposit.getStatus().toString()
        )).toList();
    }
}
