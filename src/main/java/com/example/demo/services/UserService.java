
package com.example.demo.services;

import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.stereotype.Component;

@Component
public class UserService {

    private IUserModelRepository userRepository;

    public UserService(IUserModelRepository userRepository) {
        this.userRepository = userRepository;
    }

    public UserModel getUserById(long id) throws NotFoundException {
        UserModel user = userRepository.getUserModelByCodUser(id);
        if(user == null){
            throw new NotFoundException("User not found");
        }
        return user;
    }

    public UserModel createUser(CreateUserInputDTO inputDTO){
        return userRepository.createUser(inputDTO);
    }

    public AuthenticatedUser login(LoginUserInputDTO loginUserInputDTO) throws NotFoundException {
        TokenModel token = userRepository.loginUser(loginUserInputDTO);
        if(token == null){
            throw new NotFoundException("User not found");
        }
        UserModel user = userRepository.getUserModelByToken(token.getToken().toString());

        return new AuthenticatedUser(user,token.getToken().toString());
    }

    public void logout(String token) {
        userRepository.logoutUser(token);
    }

    public UserModel getUserByToken(String token) {
        return userRepository.getUserModelByToken(token);
    }
}
