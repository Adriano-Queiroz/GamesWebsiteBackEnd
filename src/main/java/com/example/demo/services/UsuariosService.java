package com.example.demo.services;

import com.example.demo.repositories.IUserModelRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;

@Service
public class UsuariosService {

    @Autowired
    private IUserModelRepository iUserModelRepository;

    public int getTotalUsers() {
        return iUserModelRepository.totalUsers();
    }

    public int getTotalUsersBeforeEndDate(LocalDate endDate) {
        return iUserModelRepository.getTotalUsersBeforeEndDate(endDate);
    }

    public int getActiveUsers() {
        return iUserModelRepository.getActiveUsers();
    }

    public int getInactiveUsers() {
        return iUserModelRepository.getInactiveUsers();
    }

    public int getActiveUsersBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iUserModelRepository.countUsersWithDepositsBetweenDates(startDate, endDate);
    }

    public int getInactiveUsersBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iUserModelRepository.countUsersWithoutDepositsBetweenDates(startDate, endDate);
    }

}
