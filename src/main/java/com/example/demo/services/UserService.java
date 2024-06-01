/*
package com.example.demo.services;

import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.CreateUserOutputDTO;
import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.models.user.UserModel;
import org.springframework.stereotype.Component;

@Component
public class UserService {

    UserRepository userRepository;

    public CreateUserOutputDTO createUser(CreateUserInputDTO inputDTO){
        UserModel user = userRepository.createUser(inputDTO);
        return new CreateUserOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail());
    }

    public String login(LoginUserInputDTO loginUserInputDTO) {
        UserModel user = userRepository.loginUser(loginUserInputDTO);
    }
}


 */