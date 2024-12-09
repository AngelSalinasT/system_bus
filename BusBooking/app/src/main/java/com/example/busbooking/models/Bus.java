package com.example.busbooking.models;

public class Bus {
    String plates;
    String model;
    Integer capacity;

    public Bus(String plates, String model, Integer capacity) {
        this.plates = plates;
        this.model = model;
        this.capacity = capacity;
    }

    public String getPlates() {
        return plates;
    }

    public void setPlates(String plates) {
        this.plates = plates;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public Integer getCapacity() {
        return capacity;
    }

    public void setCapacity(Integer capacity) {
        this.capacity = capacity;
    }
}
