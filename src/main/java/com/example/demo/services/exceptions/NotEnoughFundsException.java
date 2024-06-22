package com.example.demo.services.exceptions;

public class NotEnoughFundsException extends Exception{
    public NotEnoughFundsException(String msg){
        super(msg);
    }
}
