package com.example.demo.models.withdrawal;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "withdrawal")
@Getter
@Setter
public class WithdrawalModel {
    @Id
    @GeneratedValue
    private long codDeposit;

    private double amount;
    @ManyToOne
    @JoinColumn(name = "codUser")
    private UserModel user;
}
