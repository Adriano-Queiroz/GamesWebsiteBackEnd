package com.example.demo.controllers;


import com.example.demo.dtos.ErrorDTO;
import com.example.demo.services.exceptions.*;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.servlet.mvc.method.annotation.ResponseEntityExceptionHandler;

@ControllerAdvice
public class ResponseExceptionHandler extends ResponseEntityExceptionHandler {
/*
    @ExceptionHandler(InvalidUsernameOrPasswordException.class)
    public ResponseEntity<ErrorDTO> handleInvalidUsernameOrPasswordException(InvalidUsernameOrPasswordException e) {
        return ResponseEntity.status(400).body(new ErrorDTO(e.getMessage()));
    }
    @ExceptionHandler(MaxEmailsPerHourException.class)
    public ResponseEntity<ErrorDTO> handleMaxEmailsPerHourException(MaxEmailsPerHourException e) {
        return ResponseEntity.status(429).body(new ErrorDTO(e.getMessage()));
    }
    @ExceptionHandler(InvalidRequestException.class)
    public ResponseEntity<ErrorDTO> handleInvalidRequestException(InvalidRequestException e) {
        return ResponseEntity.status(400).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(NotFoundException.class)
    public ResponseEntity<ErrorDTO> handleNotFoundException(NotFoundException e) {
        return ResponseEntity.status(404).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(IllegalArgumentException.class)
    public ResponseEntity<ErrorDTO> handleIllegalArgumentException(IllegalArgumentException e) {
        return ResponseEntity.status(400).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(AlreadyExistsException.class)
    public ResponseEntity<ErrorDTO> handleAlreadyExistsException(AlreadyExistsException e) {
        return ResponseEntity.status(409).body(new ErrorDTO(e.getMessage()));
    }
    @ExceptionHandler(AlreadyFriendsException.class)
    public ResponseEntity<ErrorDTO> handleAlreadyFriendsException(AlreadyFriendsException e) {
        return ResponseEntity.status(409).body(new ErrorDTO(e.getMessage()));
    }
    @ExceptionHandler(NotEnoughFundsException.class)
    public ResponseEntity<ErrorDTO> handleNotEnoughFundsException(NotEnoughFundsException e) {
        return ResponseEntity.status(403).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(InternalErrorException.class)
    public ResponseEntity<ErrorDTO> handleInternalErrorException(InternalErrorException e) {
        return ResponseEntity.status(500).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(AuthenticationException.class)
    public ResponseEntity<ErrorDTO> handleAuthenticationException(AuthenticationException e) {
        return ResponseEntity.status(401).body(new ErrorDTO(e.getMessage()));
    }
*/
@ExceptionHandler(InvalidUsernameOrPasswordException.class)
public String handleInvalidUsernameOrPasswordException(InvalidUsernameOrPasswordException e, Model model) {
    model.addAttribute("error", new ErrorDTO(e.getMessage()));
    return "error-page"; // the name of your error view
}

    @ExceptionHandler(MaxEmailsPerHourException.class)
    public String handleMaxEmailsPerHourException(MaxEmailsPerHourException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(InvalidRequestException.class)
    public String handleInvalidRequestException(InvalidRequestException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(NotFoundException.class)
    public String handleNotFoundException(NotFoundException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(IllegalArgumentException.class)
    public String handleIllegalArgumentException(IllegalArgumentException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(AlreadyExistsException.class)
    public String handleAlreadyExistsException(AlreadyExistsException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(AlreadyFriendsException.class)
    public String handleAlreadyFriendsException(AlreadyFriendsException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(NotEnoughFundsException.class)
    public String handleNotEnoughFundsException(NotEnoughFundsException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(InternalErrorException.class)
    public String handleInternalErrorException(InternalErrorException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }

    @ExceptionHandler(AuthenticationException.class)
    public String handleAuthenticationException(AuthenticationException e, Model model) {
        model.addAttribute("error", new ErrorDTO(e.getMessage()));
        return "error-page"; // the name of your error view
    }
}
