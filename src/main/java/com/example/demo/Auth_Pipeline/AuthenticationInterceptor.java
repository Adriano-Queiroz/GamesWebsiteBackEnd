package com.example.demo.Auth_Pipeline;

import com.example.demo.models.user.AuthenticatedUser;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;
import org.springframework.web.method.HandlerMethod;
import org.springframework.web.servlet.HandlerInterceptor;
import jakarta.servlet.http.HttpServletRequest;

public class AuthenticationInterceptor implements HandlerInterceptor {

    private static final String NAME_AUTHORIZATION_HEADER = "Authorization";
    private static final String NAME_WWW_AUTHENTICATE_HEADER = "WWW-Authenticate";
    private final RequestTokenProcessor authorizationHeaderProcessor;

    public AuthenticationInterceptor(RequestTokenProcessor authorizationHeaderProcessor) {
        this.authorizationHeaderProcessor = authorizationHeaderProcessor;
    }

    @Override
    public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object handler) {
        if (handler instanceof HandlerMethod handlerMethod) {
            boolean hasAuthenticatedUserParameter = false;
            for (var parameter : handlerMethod.getMethod().getParameters()) {
                if (parameter.getType().equals(AuthenticatedUser.class)) {
                    hasAuthenticatedUserParameter = true;
                    break;
                }
            }
            if (hasAuthenticatedUserParameter) {
                Cookie authorizationCookie = getCookie(request);
                AuthenticatedUser user;
                if (authorizationCookie != null) {
                    user = authorizationHeaderProcessor.processAuthorizationCookie(authorizationCookie.getValue());
                } else {
                    user = authorizationHeaderProcessor.processAuthorizationHeaderValue(request.getHeader(NAME_AUTHORIZATION_HEADER));
                }
                if (user == null) {
                    response.setStatus(401);
                    response.addHeader(NAME_WWW_AUTHENTICATE_HEADER, RequestTokenProcessor.SCHEME);
                    return false;
                } else {
                    AuthenticatedUserArgumentResolver.addUserToRequest(user, request);
                    return true;
                }
            }
        }
        return true;
    }

    private Cookie getCookie(HttpServletRequest request) {
        if (request.getCookies() != null) {
            for (Cookie cookie : request.getCookies()) {
                if (cookie.getName().equals("token")) {
                    return cookie;
                }
            }
        }
        return null;
    }

}


