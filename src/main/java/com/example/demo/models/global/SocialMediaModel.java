package com.example.demo.models.global;

import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
@Entity
@Table(name = "social_media")
public class SocialMediaModel {

        @Id
        @GeneratedValue(strategy = GenerationType.IDENTITY)
        private Long id;

        @Column(name = "name",unique = true)
        private String name;

        @Column(name = "value")
        private String value;
}
