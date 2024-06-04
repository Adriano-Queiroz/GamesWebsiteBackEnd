package com.example.demo.repositories;

import com.example.demo.models.room.RoomModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IRoomRepository extends JpaRepository<RoomModel,Long> {
}
