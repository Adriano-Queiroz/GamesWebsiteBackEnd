package com.example.demo.config;

import lombok.Getter;
import lombok.Setter;
import org.springframework.boot.context.properties.ConfigurationProperties;
import org.springframework.stereotype.Component;

@Component
@ConfigurationProperties(prefix = "ws")
@Getter
@Setter
public class WsProperties {

    private int port;
    private String type;
    private String protocol;
    private String url;
}
