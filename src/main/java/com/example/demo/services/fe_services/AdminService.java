package com.example.demo.services.fe_services;

import com.example.demo.dtos.ajustes.ChangeGlobalSetting;
import com.example.demo.models.global.GlobalModel;
import com.example.demo.repositories.IGlobalRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class AdminService {

    @Autowired
    private IGlobalRepository iGlobalRepository;

    public GlobalModel getGlobal(String name) {
        return iGlobalRepository.findByName(name).get();
    }

    public void changeGlobal(String name, Double value) {
        GlobalModel globalModel = iGlobalRepository.findByName(name).get();
        globalModel.setValue(value);
        iGlobalRepository.save(globalModel);
    }

    public void controlBonus(String name, Boolean status) {
        GlobalModel globalModel = iGlobalRepository.findByName(name).get();
        globalModel.setActive(status);
        iGlobalRepository.save(globalModel);
    }



}
