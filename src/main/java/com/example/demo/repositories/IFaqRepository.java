package com.example.demo.repositories;

import com.example.demo.models.faq.FaqModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IFaqRepository extends JpaRepository<FaqModel,Long> {
    Optional<FaqModel> findFirstByQuestionAndAnswerAndQuestionGroup(String question, String answer, int questionGroup);
}
