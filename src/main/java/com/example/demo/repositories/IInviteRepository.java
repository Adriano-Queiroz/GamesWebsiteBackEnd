package com.example.demo.repositories;

import com.example.demo.models.InviteModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IInviteRepository extends JpaRepository<InviteModel,Long> {
}
