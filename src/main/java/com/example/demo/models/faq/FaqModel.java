package com.example.demo.models.faq;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "faq")
@Getter
@Setter
public class FaqModel {

    @Id
    private Long id;
    private String question;
    private String answer;
    private int questionGroup;
}
