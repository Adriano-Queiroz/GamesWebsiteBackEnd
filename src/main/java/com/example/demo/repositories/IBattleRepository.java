package com.example.demo.repositories;

import com.example.demo.models.battle.BattleModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IBattleRepository extends JpaRepository<BattleModel,Long> {
}
