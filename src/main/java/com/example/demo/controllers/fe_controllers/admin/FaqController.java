package com.example.demo.controllers.fe_controllers.admin;

import com.example.demo.models.faq.FaqModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.models.user.role.UserRoles;
import com.example.demo.repositories.IFaqRepository;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import java.util.List;

@Controller
public class FaqController {
    @Autowired
    private IFaqRepository iFaqRepository;
    @GetMapping("/faq")
    public String faq(HttpSession session, Model model){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");
        if(!user.getUserRole().getUserRole().equals(UserRoles.ADMIN))
            return "redirect:/login";

        List<FaqModel> faqList = iFaqRepository.findAll();
        model.addAttribute("faqList", faqList);
        return "faq";
    }
    @PostMapping("/faqsubmit")
    public String submitFaq(@RequestParam Long id, @RequestParam int group, @RequestParam String question, @RequestParam String answer) {
        FaqModel faq = iFaqRepository.findById(id).get();
        faq.setQuestionGroup(group);
        faq.setQuestion(question);
        faq.setAnswer(answer);
        iFaqRepository.save(faq);
        return "redirect:/faq";
    }

}
