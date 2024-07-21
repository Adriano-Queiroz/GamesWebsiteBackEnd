package com.example.demo.services.CommomMethods;

import com.example.demo.controllers.fe_controllers.GameController;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.services.BattleService;
import com.example.demo.services.exceptions.NotFoundException;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.example.demo.controllers.fe_controllers.GameController.*;
import org.springframework.ui.Model;

@Service
public class CommonMethods {

    @Autowired
    private GameController gameController;
    @Autowired
    private BattleService battleService;
    public String isInBattle(long codUser, HttpSession session, Model model) throws NotFoundException {
        IsInBattleDTO isInBattleDTO = battleService.isInBattle(codUser);
        if (isInBattleDTO.isInBattle())
            return gameController.getLobby(isInBattleDTO.result().codBattle(),true, session, model);
        return "";
    }
}
