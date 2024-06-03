package com.example.demo.services.exceptions;

public class InvalidUsernameOrPasswordException extends Exception {
    public InvalidUsernameOrPasswordException(String msg) {
        super(msg);
    }
}
