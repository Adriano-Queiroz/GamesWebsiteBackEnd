package com.example.demo.services.exceptions;

public class AlreadyExistsException extends Exception {
    public AlreadyExistsException(String msg) {
        super(msg);
    }
}
