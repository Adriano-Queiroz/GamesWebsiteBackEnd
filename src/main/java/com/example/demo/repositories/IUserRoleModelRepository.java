package com.example.demo.repositories;

import com.example.demo.models.user.role.UserRoleModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IUserRoleModelRepository extends JpaRepository<UserRoleModel,Long> {
}
