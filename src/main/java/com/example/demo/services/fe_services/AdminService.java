package com.example.demo.services.fe_services;

import com.example.demo.models.global.GlobalModel;
import com.example.demo.models.global.SocialMediaModel;
import com.example.demo.models.room.RoomConfigModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class AdminService {

    @Autowired
    private IGlobalRepository iGlobalRepository;

    @Autowired
    private ISocialMediaRepository iSocialMediaRepository;

    @Autowired
    private IUserModelRepository iUserModelRepository;

    @Autowired
    private IRoomConfigRepository iRoomConfigRepository;

    public GlobalModel getGlobal(String name) {
        return iGlobalRepository.findByName(name).get();
    }

    public SocialMediaModel getSocialMedia(String name) {
        return iSocialMediaRepository.findByName(name).get();
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

    public void changeSocialMedia(String name, String value) {
        SocialMediaModel socialMediaModel = iSocialMediaRepository.findByName(name).get();
        socialMediaModel.setValue(value);
        iSocialMediaRepository.save(socialMediaModel);
    }

    public void creditUserBalance(Long cpf, Double value) {
        UserModel user = iUserModelRepository.findByCpf(cpf).get();
        user.setBalance(user.getBalance() + value);
        iUserModelRepository.save(user);
    }

    public void creditUserBonusBalance(Long cpf, Double value) {
        UserModel user = iUserModelRepository.findByCpf(cpf).get();
        user.setBonusBalance(user.getBonusBalance() + value);
        iUserModelRepository.save(user);
    }

    public List<RoomConfigModel> getRooms() {
        return iRoomConfigRepository.findAll();
    }

    public void removeRoom(Long id) {
        iRoomConfigRepository.findById(id).ifPresent(it -> iRoomConfigRepository.delete(it));
    }
    public void addRoom(String name, double value) {
        RoomConfigModel room = new RoomConfigModel();
        room.setName(name);
        room.setBet(value);
        iRoomConfigRepository.save(room);
    }


}
