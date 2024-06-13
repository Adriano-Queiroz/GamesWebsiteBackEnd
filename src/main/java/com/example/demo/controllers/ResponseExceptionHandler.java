package com.example.demo.controllers;


import com.example.demo.dtos.ErrorDTO;
import com.example.demo.services.exceptions.*;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.servlet.mvc.method.annotation.ResponseEntityExceptionHandler;

@ControllerAdvice
public class ResponseExceptionHandler extends ResponseEntityExceptionHandler {

    @ExceptionHandler(InvalidUsernameOrPasswordException.class)
    public ResponseEntity<ErrorDTO> handleInvalidUsernameOrPasswordException(InvalidUsernameOrPasswordException e) {
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

    @ExceptionHandler(InternalErrorException.class)
    public ResponseEntity<ErrorDTO> handleInternalErrorException(InternalErrorException e) {
        return ResponseEntity.status(500).body(new ErrorDTO(e.getMessage()));
    }

    @ExceptionHandler(AuthenticationException.class)
    public ResponseEntity<ErrorDTO> handleAuthenticationException(AuthenticationException e) {
        return ResponseEntity.status(401).body(new ErrorDTO(e.getMessage()));
    }

}
