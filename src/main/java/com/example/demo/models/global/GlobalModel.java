package com.example.demo.models.global;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
@Entity
@Table(name = "global")
public class GlobalModel {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "name",unique = true)
    private String name;

    @Column(name = "value")
    private Double value;

    @Column(name = "active")
    private Boolean active;

}
