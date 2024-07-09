package com.example.demo.repositories;

import com.example.demo.models.room.RoomConfigModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IRoomConfigRepository extends JpaRepository<RoomConfigModel, Long> {


}
