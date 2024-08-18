
package com.example.demo.services;

import com.example.demo.Auth_Pipeline.UsersDomain;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.Deposit_WithdrawalDTO;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.history.HistoryInfoDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.deposit.DepositModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.PasswordValidationInfo;
import com.example.demo.models.user.TokenValidationInfo;
import com.example.demo.models.user.UserModel;
import com.example.demo.models.withdrawal.WithdrawalModel;
import com.example.demo.repositories.*;
import com.example.demo.services.exceptions.*;
import org.apache.catalina.User;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Component;

import java.time.Clock;
import java.time.Instant;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.*;
import java.util.stream.Collectors;

@Component
public class UserService {

    private IUserModelRepository userRepository;
    private ITokenRepository tokenRepository;
    private UsersDomain usersDomain;
    private Clock clock;
    private IBattleRepository iBattleRepository;
    private GamesService gamesService;
    private IUserRoleModelRepository iUserRoleModelRepository;
    private EmailService emailService;
    private IWithdrawalRepository iWithdrawalRepository;
    private IDepositRepository iDepositRepository;
    private IHistoryRepository iHistoryRepository;

    public UserService(IUserModelRepository userRepository,
                       ITokenRepository tokenRepository,
                       UsersDomain usersDomain,
                       Clock clock,
                       IBattleRepository iBattleRepository,
                       GamesService gamesService,
                       IUserRoleModelRepository iUserRoleModelRepository,
                       EmailService emailService,
                       IWithdrawalRepository iWithdrawalRepository,
                       IDepositRepository iDepositRepository,
                       IHistoryRepository iHistoryRepository) {
        this.userRepository = userRepository;
        this.tokenRepository = tokenRepository;
        this.usersDomain = usersDomain;
        this.clock = clock;
        this.iBattleRepository = iBattleRepository;
        this.gamesService = gamesService;
        this.iUserRoleModelRepository = iUserRoleModelRepository;
        this.emailService = emailService;
        this.iWithdrawalRepository = iWithdrawalRepository;
        this.iDepositRepository = iDepositRepository;
        this.iHistoryRepository = iHistoryRepository;
    }

    public UserModel getUserById(long id) throws NotFoundException {
        return userRepository.findById(id).orElseThrow(() -> new NotFoundException("User not found"));
    }

    public UserModel createUser(String username, String email, String password, Long cpf, String phoneNumber) throws AlreadyExistsException {
        if (userRepository.findByUsername(username).isPresent()) {
            throw new AlreadyExistsException("Username Já existe");
        }
        if (userRepository.findFirstByEmail(email).isPresent()) {
            throw new AlreadyExistsException("Email Já existe");
        }
        if (!usersDomain.isSafePassword(password)) {
            throw new IllegalArgumentException("Password não é segura o suficiente");
        }
        PasswordValidationInfo passwordValidationInfo = usersDomain.createPasswordValidationInformation(password);
        UserModel user = new UserModel();
        user.setUsername(username);
        user.setEmail(email);
        user.setCpf(cpf);
        user.setPhoneNumber(phoneNumber);
        user.setPasswordValidationInfo(passwordValidationInfo.validationInfo());
        user.setBalance(0.0);
        user.setUserRole(iUserRoleModelRepository.findById(1L).get());
        return userRepository.save(user);

    }

    public AuthenticatedUser login(String username, String password) throws InvalidUsernameOrPasswordException, InternalErrorException {
        if (username.isBlank() || password.isBlank()) {
            throw new InvalidUsernameOrPasswordException("Username and password must not be empty");
        }
        UserModel user = userRepository.findByUsername(username).orElseThrow(() -> new InvalidUsernameOrPasswordException("Invalid username or password"));
        if (!usersDomain.validatePassword(password, new PasswordValidationInfo(user.getPasswordValidationInfo()))) {
            throw new InvalidUsernameOrPasswordException("Invalid username or password");
        }
        List<TokenModel> userTokens = tokenRepository.findByUser(user);
        int maxTokens = usersDomain.getMaxNumberOfTokensPerUser();

        if (userTokens.size() >= maxTokens) {
            // Sort tokens by createdAt
            userTokens.sort(Comparator.comparing(TokenModel::getCreatedAt));

            // Remove the oldest token(s) if necessary
            for (int i = 0; i <= userTokens.size() - maxTokens; i++) {
                tokenRepository.delete(userTokens.get(i));
            }
        }

        String tokenValue = usersDomain.generateTokenValue();
        Instant now = clock.instant();
        TokenModel token = new TokenModel();
        token.setTokenValidationInfo(usersDomain.createTokenValidationInformation(tokenValue).validationInfo());
        token.setCreatedAt(now);
        token.setLastUsedAt(now);
        token.setUser(user);
        tokenRepository.save(token);
        return new AuthenticatedUser(user, tokenValue);
    }

    public AuthenticatedUser loginEmail(String email, String password) throws InvalidUsernameOrPasswordException, InternalErrorException {
        if (email.isBlank() || password.isBlank()) {
            throw new InvalidUsernameOrPasswordException("Username and password must not be empty");
        }
        //Optional<UserModel> optionalUser = userRepository.findFirstByEmail(email);
        //UserModel user = userList.get(0);
        UserModel user = userRepository.findFirstByEmail(email).orElseThrow(() -> new InvalidUsernameOrPasswordException("Invalid username or password"));
        if (!usersDomain.validatePassword(password, new PasswordValidationInfo(user.getPasswordValidationInfo()))) {
            throw new InvalidUsernameOrPasswordException("Invalid username or password");
        }
        List<TokenModel> userTokens = tokenRepository.findByUser(user);
        int maxTokens = usersDomain.getMaxNumberOfTokensPerUser();

        if (userTokens.size() >= maxTokens) {
            // Sort tokens by createdAt
            userTokens.sort(Comparator.comparing(TokenModel::getCreatedAt));

            // Remove the oldest token(s) if necessary
            for (int i = 0; i <= userTokens.size() - maxTokens; i++) {
                tokenRepository.delete(userTokens.get(i));
            }
        }

        String tokenValue = usersDomain.generateTokenValue();
        Instant now = clock.instant();
        TokenModel token = new TokenModel();
        token.setTokenValidationInfo(usersDomain.createTokenValidationInformation(tokenValue).validationInfo());
        token.setCreatedAt(now);
        token.setLastUsedAt(now);
        token.setUser(user);
        tokenRepository.save(token);
        return new AuthenticatedUser(user, tokenValue);
    }

    public void logout(String token) {
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        tokenRepository.deleteById(tokenValidationInfo.validationInfo());
    }

    public UserModel getUserByToken(String token) throws AuthenticationException {
        if (!usersDomain.canBeToken(token)) {
            throw new IllegalArgumentException("Invalid Token");
        }
        TokenValidationInfo tokenValidationInfo = usersDomain.createTokenValidationInformation(token);
        TokenModel tokenModel = tokenRepository.findById(tokenValidationInfo.validationInfo()).orElseThrow(() -> new AuthenticationException("Invalid Token"));
        if (!usersDomain.isTokenTimeValid(clock, tokenModel)) {
            tokenRepository.delete(tokenModel);
            throw new AuthenticationException("Invalid Token");
        } else {
            tokenModel.setLastUsedAt(clock.instant());
            tokenRepository.save(tokenModel);
            return tokenModel.getUser();
        }


    }


    public ResponseEntity<BattleDTO> getBattleContext(long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = userRepository.findById(codUser);
        if (!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel user = optionalUser.get();
        Optional<BattleModel> optionalBattle = iBattleRepository.findFirstByPlayer1(user);
        if (!optionalBattle.isPresent())
            optionalBattle = iBattleRepository.findFirstByPlayer2(user);
        if (!optionalBattle.isPresent())
            throw new NotFoundException("Partida não encontrada");
        BattleModel battle = optionalBattle.get();
        String board = battle.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        return ResponseEntity.ok(new BattleDTO(
                board,
                gamesService.getPossibleMoves(boardArray, battle.getRoom().getGame().getGameType()),
                battle.getCodBattle(),
                battle.getStatus().toString(),
                battle.getPlayer1().getCodUser() == codUser,
                false
        ));
    }

    public void forgotPassword(String email) throws NotFoundException, MaxEmailsPerHourException {
        Optional<UserModel> optionalUser = userRepository.findFirstByEmail(email);
        if (optionalUser.isEmpty())
            throw new NotFoundException("Email errado");
        UserModel user = optionalUser.get();
        if(user.getEmailsSentInTheLastHour()>=3)
            throw new MaxEmailsPerHourException("Já enviou 3 emails na última hora, espere para podem enviar mais");
        String code = generateRandomString(20);
        user.setForgotPasswordCode(code);
        user.setEmailsSentInTheLastHour(user.getEmailsSentInTheLastHour() + 1);
        emailService.sendSimpleEmail(email,"Recuperar Senha","Código para recuperar senha:" + code);
        userRepository.save(user);
    }

    public String generateRandomString(int length) {

        String characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        Random random = new Random();
        StringBuilder randomString = new StringBuilder(length);

        for (int i = 0; i < length; i++) {
            int index = random.nextInt(characters.length());
            randomString.append(characters.charAt(index));
        }

        return randomString.toString();
    }

    public void resetPassword(String email, String forgotPasswordCode, String newPassword) throws NotFoundException, InvalidRequestException {
        Optional<UserModel> optionalUser = userRepository.findFirstByEmail(email);
        if(optionalUser.isEmpty())
            throw new NotFoundException("Email incorreto");
        UserModel user = optionalUser.get();
        if(!user.getForgotPasswordCode().equals(forgotPasswordCode))
            throw new InvalidRequestException("Código errado ou expirado");
        PasswordValidationInfo passwordValidationInfo = usersDomain.createPasswordValidationInformation(newPassword);
        user.setPasswordValidationInfo(passwordValidationInfo.validationInfo());
        userRepository.save(user);
    }

    public List<Deposit_WithdrawalDTO> getTransactions(
            Long externalReferenceId,
            Long accountUserSelected,
            String type,
            String status,
            LocalDateTime createdAtFrom,
            LocalDateTime createdAtTo,
            LocalDate fromDate,
            LocalDate toDate) {

        List<Deposit_WithdrawalDTO> transactions = new ArrayList<>();

        boolean hasFilters = externalReferenceId != null || type != null || status != null || createdAtFrom != null || createdAtTo != null;

        if (!hasFilters) {
            // No filters applied, fetch all transactions
            transactions.addAll(Deposit_WithdrawalDTO.fromDepositModel(
                    iDepositRepository.findAllByUserCodUserOrderByDateDesc(accountUserSelected)));
            transactions.addAll(Deposit_WithdrawalDTO.fromWithdrawalModel(
                    iWithdrawalRepository.findAllByUserCodUserOrderByDateDesc(accountUserSelected)));
        } else {
            // Apply filters based on type and other parameters
            if (type == null || "deposit".equalsIgnoreCase(type)) {
                List<DepositModel> deposits = iDepositRepository.findDeposits(
                        externalReferenceId, accountUserSelected, status, createdAtFrom, createdAtTo);
                transactions.addAll(Deposit_WithdrawalDTO.fromDepositModel(deposits));
            }

            if (type == null || "withdrawal".equalsIgnoreCase(type)) {
                List<WithdrawalModel> withdrawals = iWithdrawalRepository.findWithdrawals(
                        externalReferenceId, accountUserSelected, status, fromDate, toDate);
                transactions.addAll(Deposit_WithdrawalDTO.fromWithdrawalModel(withdrawals));
            }
        }

        // Sort transactions by date/time
        transactions.sort((t1, t2) -> {
            if (t1.dateTime() != null && t2.dateTime() != null) {
                return t2.dateTime().compareTo(t1.dateTime());
            } else if (t1.date() != null && t2.date() != null) {
                return t2.date().compareTo(t1.date());
            } else if (t1.dateTime() != null) {
                return 1; // t2.date() is null
            } else {
                return -1; // t1.dateTime() is null
            }
        });

        return transactions;
    }

    public List<HistoryInfoDTO> getHistory(UserModel codUser) {
        List<HistoryModel> histories = iHistoryRepository.findTop20ByPlayer1OrPlayer2OrderByCreatedAtDesc(codUser, codUser);
        return histories.stream()
                .map(history -> new HistoryInfoDTO(
                        history.getStatus().toString(),
                        history.getCodBattle(),
                        history.getRoom().getGame().getGameType().toString(),
                        history.getPlayer1().getUsername(),
                        history.getPlayer2().getUsername(),
                        history.getRoom().getBet(),
                        history.getCreatedAt()
                ))
                .collect(Collectors.toList());
    }

}


