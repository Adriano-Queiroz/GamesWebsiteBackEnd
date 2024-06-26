package com.example.demo.models.deposit;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "deposit")
@Getter
@Setter
public class DepositModel {
    @Id
    @GeneratedValue
    private long codDeposit;

    private double amount;
    @ManyToOne
    @JoinColumn(name = "codUser")
    private UserModel user;
}
