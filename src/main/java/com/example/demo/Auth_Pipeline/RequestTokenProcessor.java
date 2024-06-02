/*
package com.example.demo.Auth_Pipeline;

import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.UserService;
import org.springframework.stereotype.Component;

@Component
public class RequestTokenProcessor {

    private final UserService usersService;

    public static final String SCHEME = "bearer";

    public RequestTokenProcessor(UserService usersService) {
        this.usersService = usersService;
    }

    public AuthenticatedUser processAuthorizationHeaderValue(String authorizationValue) {
        if (authorizationValue == null) {
            return null;
        }
        String[] parts = authorizationValue.trim().split(" ");
        if (parts.length != 2) {
            return null;
        }
        if (!parts[0].equalsIgnoreCase(SCHEME)) {
            return null;
        }
        UserModel user = usersService.getUserByToken(parts[1]);
        if (user != null) {
            return new AuthenticatedUser(user, parts[1]);
        }
        return null;
    }

    public AuthenticatedUser processAuthorizationCookie(String authorizationCookie) {
        if (authorizationCookie == null) {
            return null;
        }
        UserModel user = usersService.getUserByToken(authorizationCookie);
        if (user != null) {
            return new AuthenticatedUser(user, authorizationCookie);
        }
        return null;
    }
}


 */
