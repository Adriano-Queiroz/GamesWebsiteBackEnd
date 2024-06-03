
package com.example.demo.services;

import com.example.demo.Auth_Pipeline.UsersDomain;
import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.PasswordValidationInfo;
import com.example.demo.models.user.TokenValidationInfo;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.ITokenRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.*;
import org.springframework.stereotype.Component;

import java.time.Clock;
import java.time.Instant;

@Component
public class UserService {

    private IUserModelRepository userRepository;
    private ITokenRepository tokenRepository;
    private UsersDomain usersDomain;
    private Clock clock;

    public UserService(IUserModelRepository userRepository, ITokenRepository tokenRepository, UsersDomain usersDomain, Clock clock) {
        this.userRepository = userRepository;
        this.tokenRepository = tokenRepository;
        this.usersDomain = usersDomain;
        this.clock = clock;
    }

    public UserModel getUserById(long id) throws NotFoundException {
        return userRepository.findById(id).orElseThrow(() -> new NotFoundException("User not found"));
    }

    public UserModel createUser(String username, String email, String password) throws AlreadyExistsException {
        if(userRepository.findByUsername(username).isPresent()){
            throw new AlreadyExistsException("Username already exists");
        }
        if(!usersDomain.isSafePassword(password)){
            throw new IllegalArgumentException("Password is not safe");
        }
        PasswordValidationInfo passwordValidationInfo = usersDomain.createPasswordValidationInformation(password);
        UserModel user = new UserModel();
        user.setUsername(username);
        user.setEmail(email);
        user.setPasswordValidationInfo(passwordValidationInfo.validationInfo());
        user.setBalance(0.0);
        return userRepository.save(user);

    }

    public AuthenticatedUser login(String username, String password) throws InvalidUsernameOrPasswordException, InternalErrorException {
        if(username.isBlank() || password.isBlank()){
            throw new InvalidUsernameOrPasswordException("Username and password must not be empty");
        }
        UserModel user = userRepository.findByUsername(username).orElseThrow(() -> new InvalidUsernameOrPasswordException("Invalid username or password"));
        if(!usersDomain.validatePassword(password, usersDomain.createPasswordValidationInformation(password))){
            throw new InvalidUsernameOrPasswordException("Invalid username or password");
        }
        String tokenValue = usersDomain.generateTokenValue();
        Instant now = clock.instant();
        TokenModel token = new TokenModel();
        token.setTokenValidationInfo(usersDomain.createTokenValidationInformation(tokenValue).validationInfo());
        token.setCreatedAt(now);
        token.setLastUsedAt(now);
        token.setUser(user);
        tokenRepository.save(token);
        return new AuthenticatedUser(user, tokenValue);
    }

    public void logout(String token) {
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        tokenRepository.deleteById(tokenValidationInfo.validationInfo());
    }

    public UserModel getUserByToken(String token) throws AuthenticationException {
        if(!usersDomain.canBeToken(token)){
            throw new IllegalArgumentException("Invalid Token");
        }
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        TokenModel tokenModel = tokenRepository.findById(tokenValidationInfo.validationInfo()).orElseThrow(() -> new AuthenticationException("Invalid Token"));
        if(!usersDomain.isTokenTimeValid(clock,tokenModel)){
            tokenRepository.delete(tokenModel);
            throw new AuthenticationException("Invalid Token");
        }else {
            tokenModel.setLastUsedAt(clock.instant());
            tokenRepository.save(tokenModel);
            return tokenModel.getUser();
        }


    }



}


