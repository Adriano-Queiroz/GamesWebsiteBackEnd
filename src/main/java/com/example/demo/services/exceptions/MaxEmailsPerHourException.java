package com.example.demo.services.exceptions;

public class MaxEmailsPerHourException extends Exception{
    public MaxEmailsPerHourException(String msg){
        super(msg);
    }
}
