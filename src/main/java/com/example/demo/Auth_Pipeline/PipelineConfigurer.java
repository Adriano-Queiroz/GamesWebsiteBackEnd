package com.example.demo.Auth_Pipeline;

import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.config.annotation.InterceptorRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import org.springframework.web.method.support.HandlerMethodArgumentResolver;

import java.util.List;

@Configuration
public class PipelineConfigurer implements WebMvcConfigurer {

    AuthenticationInterceptor authenticationInterceptor;
    AuthenticatedUserArgumentResolver authenticatedUserArgumentResolver;

    public PipelineConfigurer(AuthenticationInterceptor authenticationInterceptor, AuthenticatedUserArgumentResolver authenticatedUserArgumentResolver){
        this.authenticationInterceptor = authenticationInterceptor;
        this.authenticatedUserArgumentResolver = authenticatedUserArgumentResolver;
    }

    @Override
    public void addInterceptors(InterceptorRegistry registry) {
        registry.addInterceptor( authenticationInterceptor);
    }

    @Override
    public void addArgumentResolvers(List<HandlerMethodArgumentResolver> resolvers) {
        resolvers.add(authenticatedUserArgumentResolver);
    }
}
