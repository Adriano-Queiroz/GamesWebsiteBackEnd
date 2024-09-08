package com.example.demo.config.websocket;

import org.springframework.context.annotation.Configuration;
import org.springframework.messaging.simp.config.MessageBrokerRegistry;
import org.springframework.web.socket.config.annotation.*;

@Configuration
@EnableWebSocketMessageBroker
public class WebSocketConfig implements WebSocketMessageBrokerConfigurer {

    @Override
    public void configureMessageBroker(MessageBrokerRegistry registry) {
        registry.enableSimpleBroker("/topic");
        registry.setApplicationDestinationPrefixes("/ticktacktoe");
    }

    @Override
    public void registerStompEndpoints(StompEndpointRegistry registry) {
        System.out.println("HIIII");
        registry.addEndpoint("/ws")
                .setAllowedOrigins("https://localhost:9000")
                .withSockJS(); // Enable SockJS fallback for browsers that don't support WebSocket directly
    }
    /*
    @Override
    public void registerWebSocketHandlers(WebSocketHandlerRegistry registry) {
        registry.addHandler(myWebSocketHandler(), "/ws")
                .setAllowedOrigins("http://localhost:8080") // Set allowed origins here
                .withSockJS(); // Enable SockJS fallback options if needed
    }

     */
}
