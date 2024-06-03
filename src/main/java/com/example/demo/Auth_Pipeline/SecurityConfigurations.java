package com.example.demo.Auth_Pipeline;

/*
import com.example.demo.config.users.UsersDomainConfig;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configurers.AbstractHttpConfigurer;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;


import java.time.Clock;
import java.time.Duration;

@Configuration
@EnableWebSecurity
public class SecurityConfigurations{

    @Bean
    public TokenEncoder tokenEncoder() {
        return new Sha256TokenEncoder();
    }

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public UsersDomainConfig usersDomainConfig () {
        return new UsersDomainConfig(
                256/8,
                Duration.ofHours(24),
                Duration.ofHours(1),
                3
        );
    }
    @Bean
    public Clock clock() {
        return Clock.systemUTC();
    }

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
                .csrf(AbstractHttpConfigurer::disable)
                .authorizeRequests(authorize -> authorize.anyRequest().permitAll());

        return http.build();
    }
}

*/
