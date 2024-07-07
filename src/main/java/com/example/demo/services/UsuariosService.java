package com.example.demo.services;

import com.example.demo.dtos.user.FeUserDTO;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IUserModelRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

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

    public int getCountActiveUsers() {
        return iUserModelRepository.getActiveUsers();
    }

    public int getCountInactiveUsers() {
        return iUserModelRepository.getInactiveUsers();
    }

    public int getCountActiveUsersBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iUserModelRepository.countUsersWithDepositsBetweenDates(startDate, endDate);
    }

    public int getCountInactiveUsersBetweenDates(LocalDate startDate, LocalDate endDate) {
        return iUserModelRepository.countUsersWithoutDepositsBetweenDates(startDate, endDate);
    }
    public List<FeUserDTO> getAllUsers(){
        List<UserModel> userModelList = iUserModelRepository.findAllByOrderByJoinDateTimeDesc();
        return userModelList.stream().map(user -> new FeUserDTO(
                    user.getUsername(),
                    user.getEmail(),
                    user.getPhoneNumber(),
                    user.getCpf(),
                    user.getBalance(),
                    user.getBonusBalance(),
                    user.getJoinDateTime()
        )).toList();
    }
    public List<FeUserDTO> getAllUsersBetweenDates(LocalDate endDate){
        List<UserModel>  userModelList = iUserModelRepository.getAllUsersWithJoinDateBeforeEndDate(endDate);
        return userModelList.stream().map(user -> new FeUserDTO(
                user.getUsername(),
                user.getEmail(),
                user.getPhoneNumber(),
                user.getCpf(),
                user.getBalance(),
                user.getBonusBalance(),
                user.getJoinDateTime()
        )).toList();
    }
    public List<FeUserDTO> getAllInactiveUsers(){
        List<UserModel> userModelList = iUserModelRepository.findAllByLastDepositDateIsNull();
        return userModelList.stream().map(user -> new FeUserDTO(
                user.getUsername(),
                user.getEmail(),
                user.getPhoneNumber(),
                user.getCpf(),
                user.getBalance(),
                user.getBonusBalance(),
                user.getJoinDateTime()
        )).toList();
    }
    public List<FeUserDTO> getInactiveUsersBetweenDates(LocalDate startDate, LocalDate endDate){
        List<UserModel> userModelList = iUserModelRepository.findUsersWithoutDepositsBetweenDates(startDate,endDate);
        return userModelList.stream().map(user -> new FeUserDTO(
                user.getUsername(),
                user.getEmail(),
                user.getPhoneNumber(),
                user.getCpf(),
                user.getBalance(),
                user.getBonusBalance(),
                user.getJoinDateTime()
        )).toList();
    }

    public List<FeUserDTO> getAllActiveUsers(){
        List<UserModel> userModelList = iUserModelRepository.findAllByLastDepositDateIsNotNull();
        return userModelList.stream().map(user -> new FeUserDTO(
                user.getUsername(),
                user.getEmail(),
                user.getPhoneNumber(),
                user.getCpf(),
                user.getBalance(),
                user.getBonusBalance(),
                user.getJoinDateTime()
        )).toList();
    }
    public List<FeUserDTO> getActiveUsersBetweenDates(LocalDate startDate, LocalDate endDate){
        List<UserModel> userModelList = iUserModelRepository.findUsersWithDepositsBetweenDates(startDate,endDate);
        return userModelList.stream().map(user -> new FeUserDTO(
                user.getUsername(),
                user.getEmail(),
                user.getPhoneNumber(),
                user.getCpf(),
                user.getBalance(),
                user.getBonusBalance(),
                user.getJoinDateTime()
        )).toList();
    }

}
