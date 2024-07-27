package com.example.demo.models.deposit;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;
import java.time.LocalDateTime;

@Entity
@Table(name = "deposit")
@Getter
@Setter
public class DepositModel {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long codDeposit;

    private double amount;

    @ManyToOne
    @JoinColumn(name = "codUser")
    private UserModel user;

    private LocalDate date;
    private LocalDateTime dateTime;
    @Enumerated(EnumType.STRING)
    private DepositStatus status;

    @PrePersist
    protected void onCreate() {
        this.date = LocalDate.now();
        this.dateTime = LocalDateTime.now();
        user.setLastDepositDate(LocalDate.now());
    }
}
