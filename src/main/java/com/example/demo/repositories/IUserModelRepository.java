package com.example.demo.repositories;

import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IUserModelRepository extends JpaRepository<UserModel,Long> {
/*
    UserModel getUserModelByCodUser(long id);
    UserModel createUser(CreateUserInputDTO inputDTO);
    TokenModel  loginUser(LoginUserInputDTO loginUserInputDTO);
    void logoutUser(String token);
    //UserModel getUserModelByToken(TokenModel token);


 */
}
