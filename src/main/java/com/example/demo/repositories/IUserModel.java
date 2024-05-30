package com.example.demo.repositories;

import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IUserModel extends JpaRepository<UserModel,Long> {
}
