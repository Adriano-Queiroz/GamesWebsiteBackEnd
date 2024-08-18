package com.example.demo;

import com.example.demo.Auth_Pipeline.Sha256TokenEncoder;
import com.example.demo.Auth_Pipeline.TokenEncoder;
import com.example.demo.config.users.UsersDomainConfig;
import io.github.cdimascio.dotenv.Dotenv;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.autoconfigure.security.servlet.SecurityAutoConfiguration;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.scheduling.annotation.EnableScheduling;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;

import java.time.Clock;
import java.time.Duration;

@SpringBootApplication(exclude = {SecurityAutoConfiguration.class})
@EnableScheduling
public class DemoApplication extends SpringBootServletInitializer {

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
				5
		);
	}
	@Bean
	public Clock clock() {
		return Clock.systemUTC();
	}


	public static void main(String[] args) {
		Dotenv dotenv = Dotenv.configure().load();
		System.out.println("Database URL: " + dotenv.get("DATABASE_URL"));

		SpringApplication.run(DemoApplication.class, args);
	}

}
