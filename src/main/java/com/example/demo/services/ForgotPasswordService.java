package com.example.demo.services;

import com.example.demo.repositories.IUserModelRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
public class ForgotPasswordService {

    @Autowired
    private IUserModelRepository userModelRepository;

    @Scheduled(fixedRate = 3600000)
    @Transactional
    public void resetEmailsSentInTheLastHour() {
        userModelRepository.resetEmailsSentInTheLastHour();
    }
}

