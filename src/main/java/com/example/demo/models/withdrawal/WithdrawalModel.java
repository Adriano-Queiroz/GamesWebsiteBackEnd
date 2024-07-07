package com.example.demo.models.withdrawal;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;

@Entity
@Table(name = "withdrawal")
@Getter
@Setter
public class WithdrawalModel {
    @Id
    @GeneratedValue
    private long codWithdrawal;

    private double amount;
    @ManyToOne
    @JoinColumn(name = "codUser")
    private UserModel user;

    private LocalDate date;

    @PrePersist
    protected void onCreate() {
        this.date = LocalDate.now();
        user.setLastWithdrawalDate(LocalDate.now());
    }
}
