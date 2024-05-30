package com.example.demo.repositories;

import com.example.demo.models.friendship.FriendshipModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IFriendshipRepository extends JpaRepository<FriendshipModel,Long> {
}
