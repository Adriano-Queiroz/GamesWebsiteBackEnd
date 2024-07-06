package com.example.demo.models.global;


import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
@Entity
@Table(name = "global")
public class GlobalModel {

    @Id
    private Long id;

    @Column(name = "name",unique = true)
    private String name;

    @Column(name = "value")
    private String value;

}
