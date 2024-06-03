package com.example.demo.Auth_Pipeline;

import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.services.exceptions.AuthenticationException;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.core.MethodParameter;
import org.springframework.stereotype.Component;
import org.springframework.web.bind.support.WebDataBinderFactory;
import org.springframework.web.context.request.NativeWebRequest;
import org.springframework.web.method.support.HandlerMethodArgumentResolver;
import org.springframework.web.method.support.ModelAndViewContainer;

@Component
public class AuthenticatedUserArgumentResolver implements HandlerMethodArgumentResolver {

    private static final String KEY = "AuthenticatedUserArgumentResolver";

    @Override
    public boolean supportsParameter(MethodParameter parameter) {
        return AuthenticatedUser.class.equals(parameter.getParameterType());
    }

    @Override
    public Object resolveArgument(MethodParameter parameter,
                                  ModelAndViewContainer mavContainer,
                                  NativeWebRequest webRequest,
                                  WebDataBinderFactory binderFactory) throws Exception {
        HttpServletRequest request = webRequest.getNativeRequest(HttpServletRequest.class);
        if (request == null) {
            throw new IllegalStateException("TODO");
        }
        AuthenticatedUser user = getUserFrom(request);
        if (user == null) {
            throw new IllegalStateException("TODO");
        }
        return user;
    }

    public static void addUserToRequest(AuthenticatedUser user, HttpServletRequest request) {
        request.setAttribute(KEY, user);
    }

    public static AuthenticatedUser getUserFrom(HttpServletRequest request) {
        Object attribute = request.getAttribute(KEY);
        if (attribute instanceof AuthenticatedUser) {
            return (AuthenticatedUser) attribute;
        }
        return null;
    }
}
