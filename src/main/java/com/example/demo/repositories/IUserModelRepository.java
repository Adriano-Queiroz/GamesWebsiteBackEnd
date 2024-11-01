package com.example.demo.repositories;

import com.example.demo.models.user.UserModel;
import org.apache.catalina.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.transaction.annotation.Transactional;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

public interface IUserModelRepository extends JpaRepository<UserModel, Long> {
    Optional<UserModel> findByUsername(String username);
    Optional<UserModel> findFirstByEmail(String email);
    Optional<UserModel> findByCpf(Long cpf);

    @Transactional
    @Modifying
    @Query("UPDATE UserModel u SET u.emailsSentInTheLastHour = 0")
    void resetEmailsSentInTheLastHour();

    @Query("SELECT SUM(u.balance) FROM UserModel u")
    double getTotalBalance();

    @Query("SELECT COUNT(*) FROM UserModel")
    int totalUsers();

    @Query("SELECT COUNT(*) FROM UserModel WHERE joinDate <= :endDate")
    int getTotalUsersBeforeEndDate(@Param("endDate") LocalDate endDate);

    @Query("SELECT COUNT(*) FROM UserModel WHERE lastDepositDate is not null")
    int getActiveUsers();

    @Query("SELECT COUNT(*) FROM UserModel WHERE lastDepositDate is null")
    int getInactiveUsers();

    @Query("SELECT COUNT(*) FROM UserModel WHERE lastDepositDate is not null AND joinDate BETWEEN :startDate AND :endDate")
    int getActiveUsersBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT COUNT(*) FROM UserModel WHERE lastDepositDate is null AND joinDate BETWEEN :startDate AND :endDate")
    int getInactiveUsersBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT COUNT(*) FROM UserModel WHERE joinDate <= :startDate AND (lastDepositDate < :startDate OR lastDepositDate IS NULL)")
    int getUsersInactiveSince(@Param("startDate") LocalDate startDate);

    // New methods
    @Query("SELECT DISTINCT u FROM UserModel u JOIN u.deposits d WHERE d.date BETWEEN :startDate AND :endDate")
    List<UserModel> findUsersWithDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT u FROM UserModel u WHERE u.joinDate <= :endDate AND u.codUser NOT IN (SELECT DISTINCT u.codUser FROM UserModel u JOIN u.deposits d WHERE d.date BETWEEN :startDate AND :endDate)")
    List<UserModel> findUsersWithoutDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT DISTINCT u FROM UserModel u JOIN u.withdrawals d WHERE d.date BETWEEN :startDate AND :endDate")
    List<UserModel> findUsersWithWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT u FROM UserModel u WHERE u.joinDate <= :endDate and u.codUser NOT IN (SELECT DISTINCT u.codUser FROM UserModel u JOIN u.withdrawals d WHERE d.date BETWEEN :startDate AND :endDate)")
    List<UserModel> findUsersWithoutWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);
//
@Query("SELECT u FROM UserModel u WHERE u.joinDate <= :endDate")
List<UserModel> findUsersWithJoinDateBeforeDate(@Param("endDate") LocalDate endDate);

    @Query("SELECT COUNT(DISTINCT u) FROM UserModel u JOIN u.deposits d WHERE d.date BETWEEN :startDate AND :endDate")
    int countUsersWithDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);


    @Query("SELECT COUNT(u) FROM UserModel u WHERE u.joinDate <= :endDate AND u.codUser NOT IN (SELECT DISTINCT u.codUser FROM UserModel u JOIN u.deposits d WHERE d.date BETWEEN :startDate AND :endDate)")
    int countUsersWithoutDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    @Query("SELECT COUNT(DISTINCT u) FROM UserModel u JOIN u.withdrawals d WHERE d.date BETWEEN :startDate AND :endDate")
    int countUsersWithWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);


    @Query("SELECT COUNT(u) FROM UserModel u WHERE u.joinDate <= :endDate AND u.codUser NOT IN (SELECT DISTINCT u.codUser FROM UserModel u JOIN u.withdrawals d WHERE d.date BETWEEN :startDate AND :endDate)")
    int countUsersWithoutWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    List<UserModel> findAllByOrderByJoinDateTimeDesc();



    @Query("SELECT u FROM UserModel u WHERE u.joinDate <= :endDate")
    List<UserModel> getAllUsersWithJoinDateBeforeEndDate(@Param("endDate") LocalDate endDate);


    List<UserModel> findAllByLastDepositDateIsNull();
    List<UserModel> findAllByLastDepositDateIsNotNull();

    @Query(value = "SELECT * FROM user WHERE is_bot_player = true ORDER BY RAND() LIMIT 1", nativeQuery = true)
    UserModel findRandomBotPlayer();


}
